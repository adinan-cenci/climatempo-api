# Changelog
All notable changes to this project will be documented in this file.

## 2.0.0 - 2017-08-27

Several classes were refactored to make things simplier.

### Changed
- Climatempo's constructor now accepts both an array or multiple arguments, example:
new Climatempo(array(1, 2, 3, 4, 5)) or  
new Climatempo(1, 2, 3, 4, 5)
- The Search class was refactorated to be instantiable

### Added
- Climatempo::errors property is used to access an array with error messages
- The Search class now have a few methods to narrow down que search
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
- Unit tests were added

### Removed
- City lost the following methods  
City::today()  
City::tomorrow()  
City::afterTomorrow()  
City::afterAfterTomorrow()  
City::forecast()  


