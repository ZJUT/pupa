$ ->
  baseUrl="http://ajaxorg.github.com/ace/build/textarea/src/"
  load = window.__ace_loader__ = (path, module, callback)->
    $.getScript baseUrl + path, ->
      window.__ace_shadowed__.require([module], callback)

  load 'ace-bookmarklet.js', 'ace/ext/textarea', ->
    ace = window.__ace_shadowed__
    ace.options =
      mode:'markdown'
      theme:'textmate'
      gutter:'false'
      fontSize:'12px'
      softWrap:'80'
      showPrintMargin:'false'
      useSoftTabs:'true'
      showInvisibles:'true'
    enent = ace.require("ace/lib/event")
    target = $('textarea#input-descr').get(0)
    #event.addListener $('textarea#input-descr').get(0), 'click', (e)->
      #if e.detail == 3
    ace.transformTextarea(target, load)
  ###
  (
    function inject(callback) {
      var baseUrl="http://ajaxorg.github.com/ace/build/textarea/src/";
      var load = window.__ace_loader__ = function(path, module, callback) {
        var head = document.getElementsByTagName('head')[0];
        var s = document.createElement('script');
        s.src = baseUrl + path; head.appendChild(s);
        s.onload = function() {
          window.__ace_shadowed__.require([module], callback);
        };
      };
      load('ace-bookmarklet.js', "ace/ext/textarea", function() {
        var ace = window.__ace_shadowed__;
        ace.options = {
          mode:'javascript',
          theme:'textmate',
          gutter:'false',
          fontSize:'12px',
          softWrap:'80',
          showPrintMargin:'false',
          useSoftTabs:'true',
          showInvisibles:'true'
        };
        var Event = ace.require("ace/lib/event");
        var areas = document.getElementsByTagName("textarea");
        for (var i = 0; i < areas.length; i++) {
          Event.addListener(areas[i], "click", function(e) {
            if (e.detail == 3) {
              ace.transformTextarea(e.target, load);
            }
          });
        }
        callback();
      });
    })()
    ###
