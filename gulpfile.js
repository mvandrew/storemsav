var gulp                = require("gulp"),
    plumber             = require('gulp-plumber'),
    notify              = require('gulp-notify'),
    cssnano             = require("gulp-cssnano"),
    sass                = require("gulp-sass"),
    autoprefixer        = require("gulp-autoprefixer"),
    gcmq                = require('gulp-group-css-media-queries'),
    rename              = require('gulp-rename'),
    uglify              = require('gulp-uglify'),
    coffee              = require('gulp-coffee'),
    browserSync         = require('browser-sync'),
    reload              = browserSync.reload,
    del                 = require('del'),
    runSequence         = require('run-sequence'),
    zip                 = require('gulp-zip'),
    stripCssComments    = require('gulp-strip-css-comments'),
    concat              = require('gulp-concat'),
    stripComments       = require('gulp-strip-comments');

var dirs = {
    src: './src/',
    dist: './',
    build: './build/'
};

var build_files = [
    '**',
    '!build',
    '!build/**',
    '!node_modules',
    '!node_modules/**',
    '!bower_components',
    '!bower_components/**',
    '!dist',
    '!dist/**',
    '!sass',
    '!sass/**',
    '!.git',
    '!.git/**',
    '!package.json',
    '!package-lock.json',
    '!bower.json',
    '!**/*.arj',
    '!**/*.rar',
    '!**/*.zip',
    '!.gitignore',
    '!gulpfile.js',
    '!.editorconfig',
    '!.jshintrc',
    '!src',
    '!src/**',
    '!**/*.log'
];


/**
 * Browser Sync Start
 */
gulp.task('browser-sync', function () {
    var workFiles           = [
        dirs.dist + '**/*.php',
        dirs.dist + 'css/**/*.css',
        dirs.dist + 'js/**/*.js',
        dirs.dist + 'img/**/*.+(jpeg|jpg|gif|png|svg)',

        // Exclude system and core files
        '!' + dirs.src + '**/*',
        '!./node_modules/**/*'
    ];

    browserSync.init( workFiles, {
        proxy: {
            target: 'https://prime-price.ru/'
        },
        injectChanges: true
    } );
});


/**
 * SASS compile
 */
gulp.task('sass', function () {
    return gulp.src( dirs.src + 'sass/**/*.scss' )
        .pipe( plumber({ errorHandler: function(err) {
                notify.onError({
                    title: "Gulp error in " + err.plugin,
                    message:  err.toString()
                })(err);
            }}) )
        .pipe( sass() )
        .pipe( autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }) )
        .pipe( gcmq() )
        .pipe( gulp.dest(dirs.dist + 'stylesheets/') )
        .pipe( cssnano() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest(dirs.dist + 'stylesheets/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Styles task complete', onLast: true }) );
});


/**
 * Coffee script Compile
 */
gulp.task('coffee', function() {
    return gulp.src( dirs.src + 'coffee/**/*.coffee' )
        .pipe( plumber({ errorHandler: function(err) {
                notify.onError({
                    title: "Gulp error in " + err.plugin,
                    message:  err.toString()
                })(err);
            }}) )
        .pipe( coffee({bare: true}) )
        .pipe( gulp.dest(dirs.dist + 'javascripts/') )
        .pipe( uglify() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest(dirs.dist + 'javascripts/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Javascript task complete', onLast: true }) );
});


/**
 * Vendor JS Compile
 */
gulp.task('vendor-js', function () {
    return gulp.src([
        dirs.src + 'vendor/matchHeight/dist/jquery.matchHeight-min.js'
    ])
        .pipe( plumber({ errorHandler: function(err) {
                notify.onError({
                    title: "Gulp error in " + err.plugin,
                    message:  err.toString()
                })(err);
            }}) )
        .pipe( stripComments() )
        .pipe( concat('vendor-js.min.js') )
        .pipe( uglify() )
        .pipe( gulp.dest(dirs.dist + 'javascripts/') )
        .pipe( notify({ message: 'Vendor Javascripts task complete', onLast: true }) );
});


/**
 * Clear cache
 */
gulp.task('clear', function (done) {
    return cache.clearAll(done);
});


/**
 * Run the watch process
 */
gulp.task('watch', ['vendor-js', 'sass', 'coffee', 'browser-sync'], function () {

    gulp.watch( dirs.src + 'sass/**/*.scss', ['sass'] );
    gulp.watch( dirs.src + 'coffee/**/*.coffee', ['coffee'] );

});
gulp.task("default", ["watch"]);


/**
 * Clean the build folder
 */
gulp.task( 'build-clean', function() {
    return del.sync( dirs.build );
});


/**
 * Copy the theme files
 */
gulp.task( 'build-copy', function() {
    return gulp.src( build_files )
        .pipe( gulp.dest( dirs.build + '/storemsav' ) );
} );


/**
 * Zip the current release
 */
gulp.task( 'build-zip', function () {
    // Получение данных из файла пакета
    var fs = require('fs');
    var json = JSON.parse(fs.readFileSync("./package.json"));

    var packageName = json.name + '.' + json.version;

    return gulp.src( dirs.build + '/storemsav/**' )
        .pipe( zip(packageName + '.zip') )
        .pipe( gulp.dest(dirs.build + '/dest') );
});


/**
 * Build - complex task
 */
gulp.task( 'build', function() {
    return runSequence( 'build-clean', 'build-copy', 'build-zip' );
} );

