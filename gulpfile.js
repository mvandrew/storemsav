const gulp                  = require("gulp");
const plumber               = require('gulp-plumber');
const notify                = require('gulp-notify');
const cssnano               = require("gulp-cssnano");
const sass                  = require("gulp-sass");
const autoprefixer          = require("gulp-autoprefixer");
const gcmq                  = require('gulp-group-css-media-queries');
const rename                = require('gulp-rename');
const uglify                = require('gulp-uglify');
const coffee                = require('gulp-coffee');
const browserSync           = require('browser-sync');
const reload                = browserSync.reload;
const del                   = require('del');
const runSequence           = require('run-sequence');
const zip                   = require('gulp-zip');
const stripCssComments      = require('gulp-strip-css-comments');
const concat                = require('gulp-concat');
const stripComments         = require('gulp-strip-comments');
const fs                    = require('fs');
const replace               = require('gulp-replace');
const babel                 = require('gulp-babel');

const dirs = {
    src: './src/',
    dist: './',
    build: './build/'
};

const build_files = [
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
 * ===================================================================
 *
 * COMMON FUNCTIONS
 *
 * ===================================================================
 */

function gulpGetJSONData() {
    return JSON.parse(fs.readFileSync("./package.json"));
}

function gulpGetPackageVersion() {
    return gulpGetJSONData().version;
}

function gulpGetPackageName() {
    return gulpGetJSONData().name;
}



/**
 * Browser Sync Start
 */
gulp.task('browser-sync', function () {
    const workFiles           = [
        dirs.dist + '**/*.php',
        dirs.dist + '**/*.css',
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
        .pipe( replace('##version##', gulpGetPackageVersion()) )
        .pipe( sass() )
        .pipe( autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }) )
        .pipe( gcmq() )
        .pipe( gulp.dest( dirs.dist ) )
        //.pipe( cssnano() )
        //.pipe( rename({suffix: '.min'}) )
        //.pipe( gulp.dest(dirs.dist + 'stylesheets/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Styles task complete', onLast: true }) );
});


/**
 * Coffee script Compile
 *
 * DEPRECATED!!!
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
        .pipe( notify({ message: 'CoffeeScript task complete', onLast: true }) );
});


/**
 * JavaScript compile
 */
gulp.task('javascript', function() {
    return gulp.src( dirs.src + 'javascripts/**/*.js' )
        .pipe( plumber({ errorHandler: function(err) {
                notify.onError({
                    title: "Gulp error in " + err.plugin,
                    message:  err.toString()
                })(err);
            }}) )
        .pipe( babel() )
        .pipe( gulp.dest(dirs.dist + 'javascripts/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'JavaScript (ECMAScript) task complete', onLast: true }) );
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
        .pipe( concat('vendor.js') )
        .pipe( gulp.dest(dirs.dist + 'javascripts/') );
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
gulp.task('watch', ['vendor-js', 'sass', 'javascript', 'browser-sync'], function () {

    gulp.watch( dirs.src + 'sass/**/*.scss', ['sass'] );
    gulp.watch( dirs.src + 'javascripts/**/*.js', ['javascript'] );

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
    /**
     * Set the package name
     * @type {string}
     */
    const packageName = gulpGetPackageName() + '.' + gulpGetPackageVersion();

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

