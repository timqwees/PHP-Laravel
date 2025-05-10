document.addEventListener('DOMContentLoaded', function () {
 const referrer_title = document.referrer.replace('http://localhost/search/', '').replaceAll('/', '→');
 const pathSegments = referrer_title.split('→');
 let currentPath = '';

 const breadcrumb = document.createElement('div');
 breadcrumb.className = 'breadcrumb';
 const spancontent = document.createElement('span');
 spancontent.textContent = 'Навигация: ';
 breadcrumb.appendChild(spancontent);

 pathSegments.forEach((segment, i) => {
  if (segment.trim()) {
   currentPath += segment;
   const link = document.createElement('a');
   link.textContent = segment;
   link.href = `/search/${currentPath}`;
   breadcrumb.appendChild(link);

   if (i < pathSegments.length - 1) {
    breadcrumb.appendChild(document.createTextNode(' → '));
   }
   currentPath += '/';
  }
 });

 document.getElementById('referrer-title').appendChild(breadcrumb);
});