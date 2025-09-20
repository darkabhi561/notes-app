pipeline {
    agent any

    environment {
        IMAGE_NAME     = "notes-app"
        IMAGE_TAG      = "latest"
        CONTAINER_NAME = "notes-app-container"
        PORT           = "9092"
        HOST_IP        = "35.154.28.140"
    }

    stages {
        stage('Checkout') {
            steps {
                git branch: 'master',
                    credentialsId: 'GitHub_Creds',
                    url: 'https://github.com/Satyams-git/notes-app.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh '''
                echo "==== Building Docker Image ===="
                docker build -t $IMAGE_NAME:$IMAGE_TAG .
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

                    echo "==== Tagging image ===="
                    docker tag $IMAGE_NAME:$IMAGE_TAG $DOCKER_USER/$IMAGE_NAME:$IMAGE_TAG

                    echo "==== Pushing image to Docker Hub ===="
                    docker push $DOCKER_USER/$IMAGE_NAME:$IMAGE_TAG
                    '''
                }
            }
        }

        stage('Deploy Application') {
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
                    docker pull $DOCKER_USER/$IMAGE_NAME:$IMAGE_TAG

                    echo "==== Running new container ===="
                    docker run -d --name $CONTAINER_NAME -p $PORT:80 $DOCKER_USER/$IMAGE_NAME:$IMAGE_TAG
                    '''
                }
            }
        }
    }

    post {
        success {
            echo "Notes App deployed successfully: http://${HOST_IP}:${PORT}"
        }
        failure {
            echo "Build/Deploy failed. Check Jenkins logs."
        }
    }
}
