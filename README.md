#Spotify Task
- This is 8-9 step test task followed by task descriptin and visuals by figama design.
- Onboarding and spotify artist tables is created.
- Data is being saved in tables and summary can be viewd at the end.
- on adress page both country and adreess are being fetched from free open API's(sometimes the adress API took time and cause delayed response further checking it appeared that adreess API(https://nominatim.openstreetmap.org/search) caused blocked address perhaps due to location).
- Artist can be fetched by name or artist URL.
- Spotify authentication and adress API's are being handled by service classes at namespace App\Services;


#Livewire Components
- I followed each component for each screen and navigation between handled by next and previous methods on each component.
- The routes and associated components can be found in rputes.web.php.
- Spotify auth callback is handled by SpoityfyAuthCintroller.


#Veridict
- I have tested and it works fine.
- It may not have all perfect but it's enough to asseess abilities of developer.

#service classes
- a service folder is created to handle spotify and fetching location/address functionality.



#Comments
- Any feedback would be appreciated :).

#instructions
- RUn composer install.
- Run project via php artisan serve which default to localhost:8000.
- Run php artisan migrate.
- Get spotify client and secret from spotify dashboard by creating app, and update callback url to https://localhost:8000/spotify_callback.
- update the DB AND Spotify creds in .env file and run php artisan optimize:clear .
- Accessing localhost:8000 in url sholud leads to onboarding process, if everything installed correctly.
- Enjou :)

