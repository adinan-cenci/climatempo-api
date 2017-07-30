# Changelog
All notable changes to this project will be documented in this file.

## [Unreleased] - 2017-07-30

Several features were refactored

### Changed
- Climatempo's constructor now accepts both an array or multiple arguments, example:
new Climatempo(array(1, 2, 3, 4, 5)) or  
new Climatempo(1, 2, 3, 4, 5)
- The Search class was refactorated into an instantiable class

### Added
- Climatempo::errors property is used to access an array with error messages
- Search now have a few methods to inform parameters  
Search::cityName($name)  
Search::state($state)  
Search::ids($id) 
Search::setIds($id) 
- The Search class uses a .json file as database, to avoid overloading a static method was added to clear the cache  
::clearCache()
- City gained the following properties:  
City::today  
City::tomorrow  
City::afterTomorrow  
City::afterAfterTomorrow  
City::forecast (Englobs all the above)  
City::errors

### Removed

- City lost the following methods  
City::today()  
City::tomorrow()  
City::afterTomorrow()  
City::afterAfterTomorrow()  
City::forecast()  

    

Unit tests were added
