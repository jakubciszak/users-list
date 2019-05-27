pipeline {
  agent any
  stages {
    stage('Get Repo') {
      steps {
        sh 'tar --exclude=\'./folder\' --exclude=\'./package.tgz\' -zcvf /backup/filename.tgz .'
      }
    }
  }
}