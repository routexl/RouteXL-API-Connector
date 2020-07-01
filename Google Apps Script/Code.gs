/*
 * Copyright (c) 2017, RouteXL
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * 1. Redistributions of source code must retain the above copyright notice, 
 * this list of conditions and the following disclaimer.
 * 
 * 2. Redistributions in binary form must reproduce the above copyright notice, 
 * this list of conditions and the following disclaimer in the documentation 
 * and/or other materials provided with the distribution.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE 
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR 
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES 
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; 
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON 
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT 
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS 
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
*/

// Connect to the API
function api_connector(locations) {
  
  // JSON encode the locations
  var json = JSON.stringify(locations);
  
  // Add basic authorization
  var headers = { 
    "Authorization":"Basic " + Utilities.base64Encode("username:password")
  };
  
  // Set options
  var options = { 
    'method' : 'post',
    'headers' : headers,
    'contentType': 'application/x-www-form-urlencoded',
    'payload' : {'locations': json},
    'muteHttpExceptions' : true
  };
  
  // Make the request
  var response = UrlFetchApp.fetch("https://api.routexl.com/tour", options);
  if (!response) return false;
  
  // Get the answer
  var json = response.getContentText();
  var data = JSON.parse(json);
  
  // Return the route
  return data.route;
}

// Test the api connector
function test() {
  
  // Set your locations
  var locations = [
     {'name' : '1', 'lat' : 52.054290, 'lng' : 4.248618 },
     {'name' : '2', 'lat' : 52.076892, 'lng' : 4.269750 },
     {'name' : '3', 'lat' : 51.669946, 'lng' : 5.618520 },
     {'name' : '4', 'lat' : 51.589548, 'lng' : 5.432482 },
     {'name' : '5', 'lat' : 52.370200, 'lng' : 4.895100, 'restrictions' : { 'ready' : 15, 'due' : 60 } },
     {'name' : '6', 'lat' : 52.054290, 'lng' : 4.248618 }
  ];
  
  // Get the optimal route
  var route = api_connector(locations);
  
  // Log the route
  Logger.log(route);
}
