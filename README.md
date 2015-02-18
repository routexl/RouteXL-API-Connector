# RouteXL-API-Connector

PHP class to connect to the RouteXL routing optimization API

# Multi stop routing

The travelling salesman problem (TSP) asks the following question: Given a list of cities and the 
distances between each pair of cities, what is the shortest possible route that visits each city 
exactly once and returns to the origin city?

It is an NP-hard problem in combinatorial optimization, important in operations research and 
theoretical computer science. The problem was first formulated in 1930 and is one of the most 
intensively studied problems in optimization.

Source: http://en.wikipedia.org/wiki/Travelling_salesman_problem

# RouteXL

RouteXL (http://www.routexl.com/) is an online routing optimization service. RouteXL sorts
destinations in the fastest order to drive. Itineraries with multiple stops can be optimized
to save travel time and fuel costs. Route optimization lowers CO2 emissions.

The RouteXL API provides programmatic access to optimize multiple stop itineraries. Upload locations, 
get distance tables and the optimized order of stops. In the optimization time windows are 
supported. Responses are in JSON.

Read more about the API: https://www.routexl.nl/api/
