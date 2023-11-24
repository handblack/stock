###Supervisor
https://codeanddeploy.com/blog/laravel/laravel-supervisor-setup-with-example


//to read the new supervisor configurations
sudo supervisorctl reread

//then activate the new configuration
sudo supervisorctl update

//to start the queue command
//take note that this is the name of our config file above. 
//You can change it depending on your project name.
sudo supervisorctl start project-name-worker:*

//then check status if configured correctly
sudo supervisorctl status

// it will stop all queue
sudo supervisorctl stop all

// then read new configuration
sudo supervisorctl reread

// then update so that it will activate then newly added
sudo supervisorctl update

// then start all queues
sudo supervisorctl start all

// then check status
sudo supervisorctl status


supervisorctl reread
supervisorctl update
supervisorctl start telegram-work:*
supervisorctl status

### Telegram :: Manual