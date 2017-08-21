var CACHE_NAME = 'my-site-cache-v2';  
var urlsToCache = [  
  '/sentry',
  '../angular-form-builder-master/dist/angular-form-builder-components.js',
  '../angular-form-builder-master/dist/angular-form-builder.js',
  '../angular-form-builder-master/dist/angular-form-builder.css',
  '../css/paper.min.css',
  '../css/style.css'
];

self.addEventListener('install', function(event) {  
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Cache ready');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', function(event) {  
  event.respondWith(
    // We look if the request fits an element in the cache
    caches.match(event.request)
      .then(function(response) {
        if (response) {
          // We return the element in the cache
          return response;
        }
        // Otherwise we let the request look into the network
        return fetch(event.request);
      })
    );
});