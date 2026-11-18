/* Ortaq kod: tələbə və müəllim panelləri bunu istifadə edir.
   Əlaqə kanalı: ntfy.sh (pulsuz, qeydiyyatsız). Nəticələr müəllimin açarı ilə şifrələnir. */
var SNQ = (function(){
  var NTFY = 'https://ntfy.sh/';
  var LET = 'ABCDEF';
  function $(id){ return document.getElementById(id); }
  function esc(s){ return String(s == null ? '' : s).replace(/[&<>"']/g, function(c){ return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]; }); }
  function ls(k, v){ try { if (v === undefined) return JSON.parse(localStorage.getItem(k)); if (v === null) localStorage.removeItem(k); else localStorage.setItem(k, JSON.stringify(v)); } catch(e){ return null; } }
  function rid(n){ var a = new Uint8Array(n), s = ''; crypto.getRandomValues(a); for (var i = 0; i < n; i++) s += 'abcdefghijkmnpqrstuvwxyz23456789'[a[i] % 32]; return s; }
  function shuffle(a){ a = a.slice(); for (var i = a.length - 1; i > 0; i--){ var j = Math.floor(Math.random() * (i + 1)), t = a[i]; a[i] = a[j]; a[j] = t; } return a; }
  function range(n){ var r = []; for (var i = 0; i < n; i++) r.push(i); return r; }
  function wait(ms){ return new Promise(function(r){ setTimeout(r, ms); }); }
  function mmss(sec){ sec = Math.max(0, Math.round(sec)); return String(Math.floor(sec / 60)).padStart(2, '0') + ':' + String(sec % 60).padStart(2, '0'); }
  function hm(t){ var d = new Date(t); return String(d.getHours()).padStart(2,'0') + ':' + String(d.getMinutes()).padStart(2,'0'); }
  function day(t){ var d = new Date(t); return String(d.getDate()).padStart(2,'0') + '.' + String(d.getMonth()+1).padStart(2,'0') + ' ' + hm(t); }
  function b64u(u8){ var s = ''; for (var i = 0; i < u8.length; i += 0x8000) s += String.fromCharCode.apply(null, u8.subarray(i, i + 0x8000)); return btoa(s).replace(/\+/g,'-').replace(/\//g,'_').replace(/=+$/,''); }
  function ub64u(s){ s = s.replace(/-/g,'+').replace(/_/g,'/'); while (s.length % 4) s += '='; var b = atob(s), u = new Uint8Array(b.length); for (var i = 0; i < b.length; i++) u[i] = b.charCodeAt(i); return u; }
  var enc = new TextEncoder(), dec = new TextDecoder();

  function pack(obj){
    var bytes = enc.encode(JSON.stringify(obj));
    if (!window.CompressionStream) return Promise.resolve('p' + b64u(bytes));
    return new Response(new Blob([bytes]).stream().pipeThrough(new CompressionStream('deflate-raw'))).arrayBuffer().then(function(b){ return 'z' + b64u(new Uint8Array(b)); });
  }
  function unpack(str){
    var bytes = ub64u(str.slice(1));
    var p = str[0] === 'z' ? new Response(new Blob([bytes]).stream().pipeThrough(new DecompressionStream('deflate-raw'))).arrayBuffer().then(function(b){ return new Uint8Array(b); }) : Promise.resolve(bytes);
    return p.then(function(u){ return JSON.parse(dec.decode(u)); });
  }

  /* ---- kanal: göndər (hissələrə bölərək) və oxu ---- */
  function post(topic, body, tries){
    tries = tries || 3;
    return fetch(NTFY + topic, {method:'POST', body: body}).then(function(r){ if (r.ok) return true; throw r.status; })
      .catch(function(){ if (--tries <= 0) return false; return wait(1500 + Math.random() * 3000).then(function(){ return post(topic, body, tries); }); });
  }
  function publish(topic, kind, data){
    var id = rid(8), size = 3600, n = Math.max(1, Math.ceil(data.length / size)), i = 0;
    function next(){
      if (i >= n) return Promise.resolve(true);
      return post(topic, '§' + kind + '|' + id + '|' + i + '|' + n + '|' + data.slice(i * size, (i + 1) * size)).then(function(ok){ if (!ok) return false; i++; return next(); });
    }
    return next();
  }
  function readChannel(topic){
    return fetch(NTFY + topic + '/json?poll=1&since=all').then(function(r){ if (!r.ok) throw r.status; return r.text(); }).then(function(t){
      var groups = {}, list = [];
      t.split('\n').forEach(function(l){
        if (!l.trim()) return; var m; try { m = JSON.parse(l); } catch(e){ return; }
        if (m.event !== 'message' || !m.message || m.message[0] !== '§') return;
        var p = m.message.split('|'); if (p.length < 5) return;
        var g = groups[p[1]];
        if (!g){ g = groups[p[1]] = {kind: p[0].slice(1), id: p[1], n: +p[3], parts: [], time: m.time * 1000, got: 0}; list.push(g); }
        if (g.parts[+p[2]] == null){ g.parts[+p[2]] = p.slice(4).join('|'); g.got++; }
      });
      return list.filter(function(g){ return g.got === g.n; }).map(function(g){ return {kind: g.kind, id: g.id, time: g.time, data: g.parts.join('')}; });
    });
  }
  /* kanalda hazırda aktiv olan sınaq (yoxdursa null) */
  function activeQuiz(events){
    var last = null;
    events.forEach(function(e){
      if (e.kind === 'Q') last = e;
      else if (e.kind === 'X' && last && last.qid === e.data) last = null;
      if (e.kind === 'Q') e.qid = e.data.split('~')[0];
    });
    if (!last) return Promise.resolve(null);
    return unpack(last.data.split('~')[1]).then(function(z){ z.pubAt = last.time; return z; });
  }

  /* ---- şifrələmə: tələbə nəticəni müəllimin açıq açarı ilə bağlayır ---- */
  var EC = {name:'ECDH', namedCurve:'P-256'}, AES = {name:'AES-GCM', length:256};
  function genKeys(){
    return crypto.subtle.generateKey(EC, true, ['deriveKey']).then(function(k){
      return Promise.all([crypto.subtle.exportKey('jwk', k.publicKey), crypto.subtle.exportKey('jwk', k.privateKey)]);
    }).then(function(a){ return {pub:{x:a[0].x, y:a[0].y}, priv:a[1]}; });
  }
  function importPub(p){ return crypto.subtle.importKey('jwk', {kty:'EC', crv:'P-256', x:p.x, y:p.y, ext:true}, EC, false, []); }
  function seal(pub, obj){
    return Promise.all([importPub(pub), crypto.subtle.generateKey(EC, true, ['deriveKey'])]).then(function(a){
      var eph = a[1];
      return crypto.subtle.deriveKey({name:'ECDH', public:a[0]}, eph.privateKey, AES, false, ['encrypt']).then(function(key){
        var iv = crypto.getRandomValues(new Uint8Array(12));
        return Promise.all([crypto.subtle.encrypt({name:'AES-GCM', iv:iv}, key, enc.encode(JSON.stringify(obj))), crypto.subtle.exportKey('jwk', eph.publicKey)])
          .then(function(r){ return r[1].x + '.' + r[1].y + '.' + b64u(iv) + '.' + b64u(new Uint8Array(r[0])); });
      });
    });
  }
  function openSealed(privJwk, s){
    var p = s.split('.');
    return Promise.all([crypto.subtle.importKey('jwk', privJwk, EC, false, ['deriveKey']), importPub({x:p[0], y:p[1]})])
      .then(function(a){ return crypto.subtle.deriveKey({name:'ECDH', public:a[1]}, a[0], AES, false, ['decrypt']); })
      .then(function(key){ return crypto.subtle.decrypt({name:'AES-GCM', iv:ub64u(p[2])}, key, ub64u(p[3])); })
      .then(function(b){ return JSON.parse(dec.decode(b)); });
  }

  /* düz cavab linkdə açıq yazılmasın deyə sadə gizlətmə */
  function mask(qz, qid, n){ var s = 0, t = qz + qid; for (var i = 0; i < t.length; i++) s += t.charCodeAt(i); return s % n; }
  function hide(qz, qid, a, n){ return (a + mask(qz, qid, n)) % n; }
  function reveal(qz, qid, a, n){ return (a - mask(qz, qid, n) + n) % n; }

  function copy(text, btn){
    var done = function(){ var t = btn.textContent; btn.textContent = 'Kopyalandı ✓'; setTimeout(function(){ btn.textContent = t; }, 1800); };
    var fallback = function(){ var ta = document.createElement('textarea'); ta.value = text; document.body.appendChild(ta); ta.select(); try { document.execCommand('copy'); done(); } catch(e){} ta.remove(); };
    if (navigator.clipboard) navigator.clipboard.writeText(text).then(done).catch(fallback); else fallback();
  }
  var tt = null;
  function toast(msg){ var t = $('toast'); if (!t) return; t.textContent = msg; t.hidden = false; clearTimeout(tt); tt = setTimeout(function(){ t.hidden = true; }, 2600); }

  return {LET:LET, $:$, esc:esc, ls:ls, rid:rid, shuffle:shuffle, range:range, wait:wait, mmss:mmss, hm:hm, day:day, pack:pack, unpack:unpack,
    publish:publish, readChannel:readChannel, activeQuiz:activeQuiz, genKeys:genKeys, seal:seal, openSealed:openSealed,
    hide:hide, reveal:reveal, copy:copy, toast:toast};
})();
