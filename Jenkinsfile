pipeline {
  agent any
  stages {
    stage('Create Package') {
      steps {
        sh 'tar -zcvf /package.tgz .'
      }
    }
    stage('') {
      steps {
        archiveArtifacts 'package.tgz'
      }
    }
  }
}