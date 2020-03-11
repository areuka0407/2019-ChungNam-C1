window.addEventListener("load", e => {
    let customFile = document.querySelector("label.custom-file");
    if(customFile){
        customFile.innerText = "파일을 선택하세요...";

        let input = document.querySelector("#" + customFile.htmlFor); 
        input.addEventListener("input", e => {
            if(e.target.files.length > 0) {
                customFile.innerText = e.target.files[0].name;
                customFile.classList.add("active");
            }
        });
    } 
});