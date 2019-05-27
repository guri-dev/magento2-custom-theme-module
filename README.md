# Smile [Magento 2 theme]

One Paragraph of project description goes here

![alt text](https://camo.envatousercontent.com/80fcab03afdb41281db4a57b77c49ca786e7bc62/687474703a2f2f616c6f7468656d65732e636f6d2f7468656d65666f726573742f6465736372697074696f6e2f736d696c652e706e67)


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
Give examples
```

### Installing

How to install Magento 2 theme manually step by step?
This is the most popular variant of theme installation. If your new theme is just a set of files, which you receive in a .zip folder, you will need to add the theme manually.

Step 1: Unzip the theme
Unzip the archive of the theme and find two directories: app and pub.

Step 2: Upload the files

Navigate to the root directory of your Magento 2 store (use FileZilla or any other file manager). Upload the folders into the root directory.

Step 3: Use the commands
Connect the store via SSH, go to the root directory and upgrade the set up using the commands: 
php bin/magento setup:upgrade;
php bin/magento setup:static-content:deploy.

Step 4: Log in to the Admin Panel
Go to the Content>Design>Configuration and choose Edit  the store theme

Select the desired theme from the dropdown menu and click the Save Configuration button.

End with an example of getting some data out of the system or using it for a little demo

## Running the tests

Explain how to run the automated tests for this system

### Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Gurcharan Singh** - *Initial work* - [gaganphp](https://github.com/gaganphp)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
