# phramework
Composer plugin for Phramework by Jimanx2

# Installation
1 . Start with composer.json

```javascript
..
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/jimanx2/phramework.git"
    }
],
"require": {
    "jimanx2/phramework": "dev-master",
},
"autoload": {
    "psr-4": {
        "App\\": "app/"
    },
    "psr-0": {
        "Phramework\\": ""
    }
},
"scripts": {
    "phramework": [
      "Phramework\\InstallManager::runScript"
    ]
}
..
```

2 . composer install

3 . composer run-script phramework init

4 . ./phlay

# Limitation
Unix only, bye-bye windows. :p
