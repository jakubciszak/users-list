pipeline {
  agent any
  stages {
    stage('Get Repo') {
      steps {
        sh 'tar -zcvf /package.tgz .'
      }
    }
  }
}