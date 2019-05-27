pipeline {
  agent any
  stages {
    stage('Create Package') {
      steps {
        sh '''tar -zcvf ./package.tgz .

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