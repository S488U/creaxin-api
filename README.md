# Random Data API Documentation
# Creaxin API

**Welcome to the Random Data API. This API provides random user data for testing purposes.**

## Try Your Free API:
`GET https://creaxin.000webhostapp.com/?api_token=abc-def-hij-123`

Get Random Data
Returns randomly selected user data from the available dataset.

**Example Request:**

`GET https://creaxin.000webhostapp.com/?api_token=&lt;your-token&gt;`

**Example Response:**
```
[
    {
        "name": "Charlie",
        "country": "UK",
        "city": "Manchester",
        "occupation": "Designer",
        "timestamp": "2024-05-16 10:19:02"
    }
]
```
## Filter Data by Country
Returns user data filtered by country.

**Example Request:**

`GET https://creaxin.000webhostapp.com/?api_token=&lt;your-token&gt;&country=USA`

**Example Response:**

```
[
    {
        "name": "John",
        "country": "USA",
        "city": "New York",
        "occupation": "Engineer",
        "timestamp": "2024-05-16 10:23:33"
    },
    {
        "name": "Alice",
        "country": "USA",
        "city": "Los Angeles",
        "occupation": "Teacher",
        "timestamp": "2024-05-16 10:23:33"
    }
]
```

## Filter Data by City
Returns user data filtered by city within a specific country.

**Example Request:**

`GET https://creaxin.000webhostapp.com/?api_token=&lt;your-token&gt;&country=USA&city=New%20York`

**Example Response:**
```
[
    {
        "name": "John",
        "country": "USA",
        "city": "New York",
        "occupation": "Engineer",
        "timestamp": "2024-05-16 10:23:33"
    },
    {
        "name": "Alice",
        "country": "USA",
        "city": "New York",
        "occupation": "Teacher",
        "timestamp": "2024-05-16 10:23:33"
    }
]
```

## Filter Data by Count, Country, and City

Returns user data filtered by count, country, and city.

**Example Request:**

`GET https://creaxin.000webhostapp.com/?api_token=&lt;your-token&gt;&count=2&country=UK&city=Manchester`

**Example Response:**
```
[
    {
        "name": "Charlie",
        "country": "UK",
        "city": "Manchester",
        "occupation": "Designer",
        "timestamp": "2024-05-16 10:19:02"
    },
    {
        "name": "Sarah",
        "country": "UK",
        "city": "Manchester",
        "occupation": "Doctor",
        "timestamp": "2024-05-16 10:19:02"
    }
]
```
------



` www.duploader.tech `

