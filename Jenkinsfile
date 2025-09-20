
pipeline {
    agent any

    environment {
        IMAGE_NAME     = "notes-app"
        CONTAINER_NAME = "notes-app-container"
        PORT           = "9093"
        HOST_IP        = "35.154.28.140"
    }

    stages {
        stage('Checkout') {
            steps {
                git branch: 'master', url: 'https://github.com/Satyams-git/notes-app.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh '''
                echo "==== Building Docker Image ===="
                docker build -t $IMAGE_NAME .
                '''
            }
        }

        stage('Push to Docker Hub') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: 'Docker_Hub_Id_Pwd',
                    usernameVariable: 'DOCKER_USER',
                    passwordVariable: 'DOCKER_PASS'
                )]) {
                    sh '''
                    echo "==== Logging in to Docker Hub ===="
                    echo $DOCKER_PASS | docker login -u $DOCKER_USER --password-stdin

                    echo "==== Tagging Image ===="
                    docker tag $IMAGE_NAME $DOCKER_USER/$IMAGE_NAME:latest

                    echo "==== Pushing Image to Docker Hub ===="
                    docker push $DOCKER_USER/$IMAGE_NAME:latest
                    '''
                }
            }
        }

        stage('Stop Old Container') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: 'Docker_Hub_Id_Pwd',
                    usernameVariable: 'DOCKER_USER',
                    passwordVariable: 'DOCKER_PASS'
                )]) {
                    sh '''
                    echo "==== Stopping old container (if any) ===="
                    docker stop $CONTAINER_NAME || true
                    docker rm $CONTAINER_NAME || true

                    echo "==== Pulling latest image from Docker Hub ===="
                    docker pull $DOCKER_USER/$IMAGE_NAME:latest

                    echo "==== Running new container ===="
                    docker run -d --name $CONTAINER_NAME -p $PORT:80 $DOCKER_USER/$IMAGE_NAME:latest
                    '''
                }
            }
        }
    }

    post {
        success {
            echo "✅ App deployed successfully at: http://${HOST_IP}:${PORT}"
        }
        failure {
            echo "❌ Build/Deploy failed. Check Jenkins logs."
        }
    }
}
