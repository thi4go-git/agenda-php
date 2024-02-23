pipeline {

    agent any;  

    stages {
        stage('Sonar Analise') {
            environment{
                scannerHome = tool 'SONAR_SCANNER'
            }
            steps {
                withSonarQubeEnv('SONAR'){
                    sh "${scannerHome}/bin/sonar-scanner -e -Dsonar.projectKey=agenda-php  -Dsonar.sources=. -Dsonar.host.url=http://10.100.64.240:9000 -Dsonar.login="
                }
            }
        }
        stage('Sonar QualityGate') {
            steps {
                sleep(20)
                timeout(time: 1, unit: 'MINUTES'){
                    waitForQualityGate abortPipeline: true
                }
            }
        }
    
    }

   post{
        always {
            script {
                if (currentBuild.result == 'FAILURE') {
                    echo "Build Com erro(s)!"
                } else {
                    echo "Build bem-sucedido!"
                }
            }
        }
   }

}