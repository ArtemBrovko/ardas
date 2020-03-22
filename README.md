To launch this app, create `.env.local` file in root folder and specify database access credentials.
Example can be found in `.env` file (look for `DATABASE_URL` env var).

After that, execute these commands
    
    composer install
    bin/console d:s:u --force
    npm install & npm run build
    
If you use symfony console, you can run
    
    symfony serve
    
to run symfony dev server.
