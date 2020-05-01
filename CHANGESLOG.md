# Changelog
All notable changes to this project will be documented in this file.



## 4.0.0 - 2019-12-27

## Changed
- Classes Search and City moved to the namespace AdinanCenci\ClimaTempo\City

### Added
- Now, before requesting the forecast for a specific city, your token need to be 
  registered with that city's id. You can do it with the method Climatempo::addLocalesToToken
- Flood risk information can be accessed with the method Climatempo::floodingRisk



## 3.1.0 - 2018-04-15

### Added
- Now it is possible to request the weather history of a city.
  See examples.

## 3.0.1 - 2018-01-06

### Changed
- Examples of use adjusted to be clearer.  
- Climatempo class can now make post requests.  

## 3.0.0 - 2017-12-09

### Changed
- Now that Climatempo provides a decent API for developers, we moved from 
  scraping a xml file to using said API.

- The new API needs an access token, this token can be generated after creating  
  an account in advisor.climatempo.com.br

- It is no longer possible to get information for more than one city per request.

- Now with the new API, a great deal more of data is available and the arrays that 
  returned from the requests were replaced with objects.

- Upon error, the requests to the API will throw Exceptions.

## 2.0.2 - 2017-09-02

- Moved phpUnit from requirements to dev requirements

## 2.0.0 - 2017-08-27

- Several classes were refactored to make things simpler.

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
- The Search class uses a .json file as database, to avoid overloading a static 
  method was added to clear the cache ::clearCache()
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


