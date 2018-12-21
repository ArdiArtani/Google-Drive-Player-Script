# Google Drive Player Script
[![GitHub issues](https://img.shields.io/github/issues/ArdiArtani/Google-Drive-Player-Script.svg)](https://github.com/ArdiArtani/Google-Drive-Player-Script/issues)
[![GitHub forks](https://img.shields.io/github/forks/ArdiArtani/Google-Drive-Player-Script.svg)](https://github.com/ArdiArtani/Google-Drive-Player-Script/network)
[![GitHub stars](https://img.shields.io/github/stars/ArdiArtani/Google-Drive-Player-Script.svg)](https://github.com/ArdiArtani/Google-Drive-Player-Script/stargazers)
[![GitHub license](https://img.shields.io/github/license/ArdiArtani/Google-Drive-Player-Script.svg)](https://github.com/ArdiArtani/Google-Drive-Player-Script/blob/master/LICENSE)
[![Twitter](https://img.shields.io/twitter/url/https/github.com/ArdiArtani/Google-Drive-Player-Script.svg?style=social)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2FArdiArtani%2FGoogle-Drive-Player-Script)

## Getting Started
Grab Google Drive streaming links (redirector.googlevideo.com/videoplayback?..). You can use it for video players (jwplayer, videojs, plyr etc).
![](https://i.imgur.com/ituSMQm.png)

### Notes
- Requires a Google Drive API key (create one [here](https://developers.google.com/drive/api/v3/enable-sdk)).
- Grab one streaming hotlink
- .mkv won't have sound (convert to mp4)

### Prerequisites
- Web Hosting or VPS ([Namecheap](https://affiliate.namecheap.com/?affId=61218))
- PHP 5+ or greater (suggest PHP 7.x)

## Deployment
Put all files into the public/htdocs directory.

In drive.php enter your google drive api key (googledrive_key)

## Usage
`http://<yourdomain.com>/?url=https://drive.google.com/file/d/[ID]/view`

Live Demo: [https://googledriveplayer.herokuapp.com/](https://googledriveplayer.herokuapp.com/)

### How to Find the Google Drive URL
* Share that video
* Get shareable link https://drive.google.com/file/d/[ID]/view?usp=sharing

## Built With
* [PHP Simple HTML DOM Parser](http://simplehtmldom.sourceforge.net/) - A HTML DOM parser written in PHP5+
* [Plyr](https://github.com/sampotts/plyr) - A simple HTML5, YouTube and Vimeo player

## Contributing
Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning
We use [SemVer](https://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/ArdiArtani/Google-Drive-Player-Script/tags).

## Authors
* **ArdiArtani** - *Initial work* - [ArdiArtani](https://github.com/ArdiArtani)

See also the list of [contributors](https://github.com/ArdiArtani/Google-Drive-Player-Script/contributors) who participated in this project.

## Donate
* Ripple (XRP): rNbRzhFaX2XQfRzY7CxkDqEHNFBAbCfJML
* Ethereum (ETC): 0x95082b9016bc6437565cccec38d544d26e7cfbbd
* Paypal: [Donate](https://www.paypal.me/ArdiArtani)

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
