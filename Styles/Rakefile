require 'rake/clean'

LESS_FILES = FileList['less/**/*.less']

TARGETS = %w(css/application.css)
CLEAN.concat(TARGETS)

task :default => TARGETS

desc 'Run tests'
task :test do
    # run tests here
end

desc 'Build css bundle'
file 'css/application.css' => LESS_FILES do |t|
    mkdir_p 'css'
    sh "lessc --strict-math=on less/application.less | postcss -u autoprefixer -u cssnano -o #{t.name}"
end
