export default {
  "source": [
    "tokens/**/*.json"
  ],
  "platforms": {
    "scss": {
      "transformGroup": "scss",
      "buildPath": "build/scss/",
      "files": [
        {
          "destination": "setup.scss",
          "format": "scss/variables",
          "options": {
            "outputReferences": true,
          }
        }
      ]
    }
  }
}
