pipeline {
    agent any
    
    environment {
        IMAGE_NAME = "notes-app"
        CONTAINER_NAME= "notes-app-container"
        PORT= "9092"
    }
    stages {
        stage ("Checkout") {
            steps {
                git branch: 'master',url:'https://github.com/darkabhi561/notes-app.git'
           }
        }
        
       stage ("Build Docker Image") {
          steps {
            sh '''
            echo "--------Building Docker Image==="
            docker build -t $IMAGE_NAME .
            '''
            }
        }
        
        stage ("Push to docker hub") {
            steps{
                withCredentials([usernamePassword(credentialsId:'Docker_Hub_Pwd',usernameVariable:'DOCKER_USER',passwordVariable:'DOCKER_PASS')])
                {
                sh'''
                echo '----------------logging into the Docker hub-------------'
                echo $DOCKER_PASS | docker login -u $DOCKER_USER --password-stdin
                
                echo '-------tagging image--------'
                docker tag $IMAGE_NAME $DOCKER_USER/$IMAGE_NAME:latest
                
                echo '---------pusing image to docker hub---------'
                docker push $DOCKER_USER/$IMAGE_NAME:latest
                '''
                }
                
            }
        }
        
        stage ("Stop old Container") {
            steps {
                sh '''
                echo "-----------Stop Old Containers-----------"
                docker stop $CONTAINER_NAME || true
                docker rm  $CONTAINER_NAME || true
                '''
            }
        }
      stage ("Running Container") {
          steps {
              sh '''
              echo "---------Running new containers---------"
              docker run -d --name  $CONTAINER_NAME -p $PORT:80 -v notes-data:/data $IMAGE_NAME
              '''
          }
      }
      stage ("Verify") {
          steps {
             sh'''
             echo "-----------Checking app response----------"
             sleep 5
             curl -s http://13.235.20.6:$PORT | head -n 20
             '''
          }
      }
    }
        post {
            success {
                echo "Notes app Deployment"
            }
        }
  
}
