if (window.Worker !== undefined) {
    addEventListener('load', () => {
        var codeBlocks = document.querySelectorAll('.wpd-comment pre.ql-syntax');
        wpDiscuzSyntaxHiglight(codeBlocks);
        if (wpdiscuzAjaxObj.syntaxCustomSelector) {
            var customCodeBlocks = document.querySelectorAll(wpdiscuzAjaxObj.syntaxCustomSelector);
            if(customCodeBlocks instanceof NodeList){
                wpDiscuzSyntaxHiglight(customCodeBlocks);
            }
        }
    });

    var wpdMutationObserver = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            if (mutation.type === 'childList' && mutation.addedNodes !== null && typeof mutation.target.classList === "object" && (mutation.target.classList.contains('wpd-comment-text') || mutation.target.classList.contains('wpd-comment-right') || mutation.target.classList.contains('wpd-thread-list'))) {
                mutation.addedNodes.forEach(function (node) {
                    if (typeof node.classList === "object") {
                        if (node.classList.contains('wpd-comment-text') || node.classList.contains('wpd-comment')) {
                            var codeBlocks = node.querySelectorAll('pre.ql-syntax');
                            wpDiscuzSyntaxHiglight(codeBlocks);
                        } else if (node.classList.contains('ql-syntax')) {
                            var codeBlocks = [node];
                            wpDiscuzSyntaxHiglight(codeBlocks);
                        }
                    }
                });
            }
        });
    });

    var wpdcom = document.getElementById('wpdcom');
    wpdMutationObserver.observe(wpdcom, {
        childList: true,
        subtree: true,
    });

    function wpDiscuzSyntaxHiglight(codeBlocks) {
        codeBlocks.forEach(function (codeBlock) {
            if (!codeBlock.classList.contains('hljs')) {
                codeBlock.classList.add('hljs');
            }
            codeBlock.innerHTML = codeBlock.innerHTML.replace(/<br\s*[\/]?>/gi, "\r\n");
            var worker = new Worker(encodeURI(wpdiscuzAjaxObj.syntaxWorkerURL));
            worker.onmessage = (message) => {
                codeBlock.innerHTML = message.data;
            }
            
            worker.postMessage({html: codeBlock.textContent, package: wpdiscuzAjaxObj.syntaxPackage, languages: wpdiscuzAjaxObj.syntaxLanguages});
        });
    }
}