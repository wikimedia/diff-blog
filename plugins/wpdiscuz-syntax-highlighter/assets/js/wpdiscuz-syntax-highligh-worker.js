onmessage = (message) => {
    importScripts('../highlight/'+ message.data.package + '-highlight.js');
    const result = self.hljs.highlightAuto(message.data.html,message.data.languages);
    postMessage(result.value);
};