/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/pages/dashboard.init.js ***!
  \**********************************************/
/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Dashboard Init Js File
*/
// get colors array from the string
function getChartColorsArray(chartId) {
  var colors = $(chartId).attr('data-colors');
  var colors = JSON.parse(colors);
  return colors.map(function (value) {
    var newValue = value.replace(' ', '');

    if (newValue.indexOf('--') != -1) {
      var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
      if (color) return color;
    } else {
      return newValue;
    }
  });
} //   spline_area


var splneAreaColors = getChartColorsArray("#spline_area");
var options = {
  chart: {
    height: 350,
    type: 'area',
    toolbar: {
      show: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    width: 3
  },
  series: [{
    name: 'Target',
    data: [100, 900, 280, 520, 420, 109, 100]
  }, {
    name: 'Realisasi',
    data: [90, 600, 280, 560, 360, 152, 241]
  }],
  colors: splneAreaColors,
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
    title: {
      text: 'Bulan (Tahun Berjalan)'
    }
  },
  yaxis: {
    title: {
      text: 'Juta - Milyar'
    },
    min: 10,
    max: 1000
  },
  grid: {
    borderColor: '#f1f1f1'
  },
  tooltip: {
    x: {
      format: 'dd/MM/yy HH:mm'
    }
  }
};
var chart = new ApexCharts(document.querySelector("#spline_area"), options);
chart.render(); // pie chart

var pieColors = getChartColorsArray("#pie_chart");
var options = {
  chart: {
    height: 480,
    type: 'pie'
  },
  series: [440, 550, 410, 170, 150],
  labels: ['Hotel', 'Rumah Makan', 'Reklame', 'Tambang Mineral', 'PJU'],
  colors: pieColors,
  legend: {
    show: true,
    position: 'bottom',
    horizontalAlign: 'center',
    verticalAlign: 'middle',
    floating: false,
    fontSize: '20px',
    offsetX: 0
  },
  responsive: [{
    breakpoint: 600,
    options: {
      chart: {
        height: 260
      },
      legend: {
        show: false
      }
    }
  }]
};
var chart = new ApexCharts(document.querySelector("#pie_chart"), options);
chart.render();
/******/ })()
;