/*
* Dependencias
*/
const gulp = require('gulp');
// const uglify = require('gulp-uglify');
const pug = require('gulp-pug');
const image = require('gulp-image');
// const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
// const autoprefixer = require('autoprefixer');
const sassmixins = require('gulp-sass-to-postcss-mixins');
const postcssPresetEnv = require('postcss-preset-env');
const precss = require('precss');
const cssnano = require('cssnano');
const atImport = require("postcss-import");
// const combineMq = require("postcss-combine-media-query");
const browsersync = require('browser-sync').create();

var source_paths = {
    js: './dev/src/js/**/*.js',
    views_pug: './dev/views/pug/*.pug',
    css: './dev/src/css/*.css'
}

// gulp.task('sass', function(){
//     return gulp.src(source_paths.sass)
//     .pipe(sass().on('error', sass.logError))
//     .pipe(gulp.dest('./dist/src/css/'))
//     .pipe(browsersync.stream({match:'**/*.css'}))
// })

gulp.task('css', function () {
    var processors = [
        postcssPresetEnv({
            autoprefixer: {
                grid: true
            },
            browsers: [
                "last 2 version"
            ],
            stage: 3,
            features: {
                'nesting-rules': true
            },
            preserve: false
        }),
        atImport,
        precss,
        // cssnano({
        //     calc: {precision: 2}
        // }),
    ];
    return gulp.src(source_paths.css)
    .pipe(sassmixins())
    .pipe(postcss(processors))
    .pipe(gulp.dest('./dist/src/css/'))
    .pipe(browsersync.stream())
});

gulp.task('pug', function() {
    return gulp.src(source_paths.views_pug)
    .pipe(pug({
        pretty: true
    }))
    .pipe(gulp.dest('./dist/'))
});

gulp.task('jsmin', function() {
    return gulp.src(source_paths.js)
    .pipe(uglify())
    .pipe(gulp.dest('./dist/src/js/'))
});

gulp.task('images', function () {
    gulp.src('./dev/src/images/**/*.*')
      .pipe(image())
      .pipe(gulp.dest('./dist/src/images/'));
});

gulp.task('default', () => {
    gulp.watch('./dev/views/pug/**/*.pug', gulp.series('pug'));
    gulp.watch('./dev/src/css/**/*.css', gulp.series('css'));
    // gulp.watch('./dev/src/sass/**/*.scss', gulp.series('sass'));
    gulp.watch('./dist/**/*.html').on('change', browsersync.reload);
    browsersync.init({
        server: {
            watch: true,
            baseDir: 'dist'
        }
    })
});
