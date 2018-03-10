"use strict";

var gulp = require("gulp");
var sass = require("gulp-sass");
var plumber = require("gulp-plumber");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var server = require("browser-sync").create();
var minify = require("gulp-csso");
var rename = require("gulp-rename");
var imagemin = require("gulp-imagemin");
var del = require("del");
var run = require("run-sequence");
var uglify = require("gulp-uglify");
var pump = require("pump");
var csscomb = require("gulp-csscomb");
var gnf = require('gulp-npm-files');
var svgstore = require("gulp-svgstore");


gulp.task("clean", function() {
  return del("/var/www/floorball/wp-content/themes/floorball/*",{force:true});
});

gulp.task("copy", function() {
  return gulp.src([
    "fonts/**",
    "inc/**",
    "img/**",
    "languages/**",
    "layouts/**",
    "js/**",
    "js-mini/**",
    "template-parts/**",
    "*.php",
    "rtl.css"
  ], {
    base: "."
  })
  .pipe(gulp.dest("/var/www/floorball/wp-content/themes/floorball/"));
});

gulp.task("copyNpmDependenciesOnly", function() {
  gulp.src(gnf(), {base:'./'})
  .pipe(gulp.dest('/var/www/floorball/wp-content/themes/floorball/'));
});

gulp.task("svgsprite", function() {
  var sources = gulp
  .src("img/icons/*.svg")
  .pipe(svgstore({
      inlineSvg: true
    }))

  .pipe(rename("svg-icons.svg"))
  .pipe(gulp.dest("/var/www/floorball/wp-content/themes/floorball/img/"));
});


gulp.task("style", function() {
  gulp.src("sass/style.scss")
    .pipe(plumber())
    .pipe(sass({
            includePaths: require('node-normalize-scss').includePaths
          }))
    .pipe(postcss([
      autoprefixer({browsers: [
        "last 2 versions"
      ]})
    ]))
    .pipe(csscomb())
    .pipe(gulp.dest("/var/www/floorball/wp-content/themes/floorball"))
//    .pipe(minify())
//    .pipe(rename("style.min.css"))
//    .pipe(gulp.dest("build/css"))

    .pipe(server.stream());
});

gulp.task("images", function(){
  return gulp.src("build/img/**/*.{png,jpg,gif}")
  .pipe(imagemin([
    imagemin.optipng({optimizationLevel: 3}),
    imagemin.jpegtran({progressive: true})
  ]))
  .pipe(gulp.dest("build/img"));
});

gulp.task("compress", function(cb){
  pump([
    gulp.src("build/js/**/*.js"),
    uglify(),
    gulp.dest("build/js-mini")
    ],
    cb
    );
});

gulp.task("build", function(fn) {
  run("clean",
      "copy",
      "copyNpmDependenciesOnly",
//      "svgsprite",
      "style",
//      "images",
//      "compress",
      fn);
});

gulp.task("php:copy", function(){
  return gulp.src("*.php")
  .pipe(gulp.dest("/var/www/floorball/wp-content/themes/floorball"));
});

/*gulp.task("php:update", ["php:copy"], function(done){
  server.reload();
  done();
});*/

gulp.task("serve", function() {
/*  server.init({
    server: "floorball.ru",
    notify: false,
    open: true,
    cors: true,
    ui: false
  });*/

  gulp.watch("sass/**/*.{scss,sass}", ["style"]);
  gulp.watch("*.php", ["php:copy"]);
});
