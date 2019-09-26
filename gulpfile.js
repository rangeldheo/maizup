"use strict";

const gulp = require("gulp");
const sass = require("gulp-sass");

sass.compiler = require("node-sass"); //Necessário para funcionar gulp-sass

gulp.task('default', watch);

gulp.task("sass", compilaSass);

function compilaSass() {
    return gulp
        .src("themes/default/assets/scss/*.scss")
        .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError)) // Converte Sass para CSS mimificado com gulp-sass
        .pipe(gulp.dest("themes/default/assets/css"));
}

function watch() {
    gulp.watch("themes/default/assets/scss/*.scss", compilaSass);
}