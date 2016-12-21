eval "$(ssh-agent -s)"
openssl aes-256-cbc -K $encrypted_f4692d717c58_key -iv $encrypted_f4692d717c58_iv -in .travis/deploy_key.pem.enc -out .travis/deploy_key.pem -d
chmod 600 .travis/deploy_key.pem
ssh-add .travis/deploy_key.pem
