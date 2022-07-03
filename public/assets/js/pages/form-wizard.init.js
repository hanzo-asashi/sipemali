/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/pages/form-wizard.init.js ***!
  \************************************************/
/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Form wizard Js File
*/
$(document).ready(function () {
  $('#step-wizard-wajib-pajak').bootstrapWizard({
    'tabClass': 'nav nav-pills nav-justified'
  });
}); // Active tab pane on nav link

var triggerTabList = [].slice.call(document.querySelectorAll('.twitter-bs-wizard-nav .nav-link'));
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl);
  triggerEl.addEventListener('click', function (event) {
    event.preventDefault();
    tabTrigger.show();
  });
});
/******/ })()
;