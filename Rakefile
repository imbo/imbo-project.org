require 'date'
require 'digest/md5'
require 'fileutils'

basedir  = "."
build    = "#{basedir}/build"
tests    = "#{basedir}/tests"

desc "Task used by Jenkins-CI"
task :jenkins => [:lint, :prepare, :installdep, :test]

desc "Task used by Travis-CI"
task :travis => [:installdep, :test]

desc "Default task"
task :default => [:lint, :prepare, :installdep, :test]

desc "Test task"
task :test => [:phpunit]

desc "Clean up and create artifact directories"
task :prepare do
  FileUtils.rm_rf build
  FileUtils.mkdir build

  ["coverage"].each do |d|
    FileUtils.mkdir "#{build}/#{d}"
  end
end

desc "Check syntax on all php files in the project"
task :lint do
  `git ls-files "*.php"`.split("\n").each do |f|
    begin
      sh %{php -l #{f}}
    rescue Exception
      exit 1
    end
  end
end

desc "Install dependencies"
task :installdep do
  if ENV["TRAVIS"] == "true"
    system "composer --no-ansi install --dev"
  else
    Rake::Task["install_composer"].invoke
    system "php -d \"apc.enable_cli=0\" composer.phar install --dev"
  end
end

desc "Update dependencies"
task :updatedep do
  Rake::Task["install_composer"].invoke
  system "php -d \"apc.enable_cli=0\" composer.phar update --dev"
end

desc "Install/update composer itself"
task :install_composer do
  if File.exists?("composer.phar")
    system "php -d \"apc.enable_cli=0\" composer.phar self-update"
  else
    system "curl -s http://getcomposer.org/installer | php -d \"apc.enable_cli=0\""
  end
end

desc "Run unit tests"
task :phpunit do
  config = "tests/phpunit.xml.dist"

  if ENV["TRAVIS"] == "true"
    config = "tests/phpunit.xml.travis"
  elsif File.exists?("tests/phpunit.xml")
    config = "tests/phpunit.xml"
  end

  begin
    sh %{vendor/bin/phpunit --verbose -c #{config} --coverage-html #{build}/coverage}
  rescue Exception
    exit 1
  end
end
