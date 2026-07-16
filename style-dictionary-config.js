export default {
  "source": [
    "tokens/**/*.json"
  ],
  "platforms": {
    "scss": {
      "transformGroup": "scss",
      "buildPath": "storage/app/public/",
      "files": [
        {
          "destination": "variables.css",
          "format": "css/variables",
          "options": {
            "outputReferences": true,
          }
        }
      ]
    }
  }
}
