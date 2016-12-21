DIRS = %w(API Framework Frontend Styles Application Worker Library Ink Locale Survey)

task default: DIRS.map(&:downcase)

DIRS.each do |dir|
    desc "Build #{dir}"
    task dir.downcase do
        sh "cd #{dir} && rake"
    end
end

%w(clean deps test).each do |task_name|
  desc "Run #{task_name} for all subdirectories"

  task task_name do
    DIRS.each do |dir|
      sh "cd #{dir} && rake #{task_name}"
    end
  end
end

desc "Builds the RPM packages"
task :rpm do
  sh './scripts/build-packages.sh'
end
