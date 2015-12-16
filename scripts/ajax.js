"use strict";

var ajax = {};

ajax.xhr = function() {
  if (typeof XMLHttpRequest !== 'undefined') {
    return new XMLHttpRequest();
  }
  var versions = [
    "MSXML2.XmlHttp.6.0",
    "MSXML2.XmlHttp.5.0",
    "MSXML2.XmlHttp.4.0",
    "MSXML2.XmlHttp.3.0",
    "MSXML2.XmlHttp.2.0",
    "Microsoft.XmlHttp"
  ];

  var xhr;
  for(var i = 0; i < versions.length; i++) {
    try {
      xhr = new ActiveXObject(versions[i]);
      break;
    } catch (e) {
    }
  }
  return xhr;
};

ajax.send = function(url, callback, method, data) {
  var xhr = ajax.xhr();
  xhr.open(method, url);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      callback(xhr.responseText)
    }
  };
  if (method == 'POST') {
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  }
  xhr.send(data)
};

ajax.get = function(url, data, callback) {
  var query = [];
  for (var key in data) {
    query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
  }
  ajax.send(url + (query.length ? '?' + query.join('&') : ''), callback, 'GET', null)
};

ajax.post = function(url, data, callback) {
  var query = [];
  for (var key in data) {
    query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
  }
  ajax.send(url, callback, 'POST', query.join('&'))
};
