pipeline {
  agent any
  stages {
    stage('Create Package') {
      steps {
        sh '''touch package.tgz
tar -cf --exclude=\'package.tgz\' --exclude=\'./.git\' ./package.tgz .

ls -la ./'''
      }
    }
    stage('error') {
      steps {
        archiveArtifacts 'package.tgz'
      }
    }
  }
}