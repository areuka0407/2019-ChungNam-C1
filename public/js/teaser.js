
/* Helper
*/
function IDBParse(data){
    return /^([0-9]+)$/.test(data) ? parseInt(data) : data;
}

/**
 * Prototype
 */
String.prototype.toElem = function(){
    let elem = document.createElement("div");
    elem.innerHTML = this;
    return elem.firstElementChild;
}

String.prototype.toElemInDiv = function(){
    let elem = document.createElement("div");
    elem.classList.add("topper");
    elem.innerHTML = this;
    return elem;
}

String.prototype.rgbtohex = function(){
    let matches = /rgb\(\s*(?<red>[0-9]+)\s*,\s*(?<green>[0-9]+)\s*,\s*(?<blue>[0-9]+)\s*\)/.exec(this);
    let result = "";

    for(let key in matches.groups){
        let val = parseInt(matches.groups[key]);
        result += val == 0 ? "0" : val.toHex();
    }

    return "#" + result;
}

Number.prototype.toHex = function(){
    let result = [];
    let _this = parseInt(this);
    
    while(_this > 0){
        result.push( transHex(_this % 16) );
        _this = parseInt(_this / 16);
    }

    return result.reverse().join("");
}
function transHex(num){
    switch(parseInt(num)){
        case 10: return "A";
        case 11: return "B";
        case 12: return "C";
        case 13: return "D";
        case 14: return "E";
        case 15: return "F";
        default: return num;
    }
}

Element.prototype.setStyle = function(lists){
    for(let prop in lists){
        this.style[prop] = lists;
    }
}


location.getValue = function(keyword = ""){
    let result = {};
    keyword = keyword === "" ?  this.search : keyword;

    while(/(?<key>[^&?]+)=(?<value>[^&?]+)/.test(keyword)){
        let matches = /(?<key>[^&?]+)=(?<value>[^&?]+)/.exec(keyword)
        result[matches.groups.key] = matches.groups.value;

        let text = matches[0];
        keyword = keyword.substr(keyword.indexOf(text) + text.length);
    }

    return result;
}

window.addEventListener("load", e => {
    /**
     * 각 페이지별 이벤트 정리
     */
    let func = {
        visual_1(elem){
            elem.animated && clearInterval(elem.animated);

            elem.querySelectorAll(".isClone").forEach(x => x.remove());

            let cs = 0; // current slide
            let container = elem.querySelector(".images > div");
            let images = elem.querySelectorAll(".image"); // 기존 이미지 배열

            $(container).css("top", "0");
            images.forEach((x, i) => {
                x.dataset.no = i;
            });
            
            if(images.length < 2) return; 
            

            let lastClone = images[images.length - 1].outerHTML.toElem();
            lastClone.classList.add("isClone");
            container.prepend(lastClone);

            let firstClone = images[0].outerHTML.toElem();
            firstClone.classList.add("isClone");
            container.append(firstClone);

            let secondClone = images[1].outerHTML.toElem();
            secondClone.classList.add("isClone");
            container.append(secondClone);


            let _images = elem.querySelectorAll(".image"); // 클론까지 추가한 이미지 배열
            $(container).css("height", _images.length * 100 + "%");

            let i_height = container.offsetHeight / _images.length;

            $(_images).css({
                transform: "scale(0.8)",
                opacity: "0.5",
                transition: "1s",
                height: i_height + "px"
            })
            $(_images).eq(1).css({transform: "scale(1)", opacity: "1"})

            
            $(container).css("top", `-${i_height}px`);
        
            elem.animated = setInterval(() => {
                cs++;
                $(_images).css({transform: "scale(0.8)", opacity: "0.5"});
                $(elem.querySelectorAll(`.image[data-no="${cs >= images.length ? 0 : cs}"]`)).css({transform: "scale(1)", opacity: "1"});
                $(container).animate({top: `${-i_height + i_height * -cs}px`}, 1000, () => {
                    if(cs + 1 > images.length){
                        $(container).css("top", `-${i_height}px`);
                        cs = 0;
                    }
                });
            }, 3000);

        },

        visual_2(elem){
            console.log(elem);
            elem.animated && clearInterval(elem.animated);

            let cs = 0;

            let images = elem.querySelectorAll(".images > img");
            $(images).css({
                opacity: "1",
                display: "block"
            });

            if(images.length < 2) {
                $(images).fadeIn();
                return;
            }

            $(images).not(`:eq(0)`).fadeOut();

            elem.animated = setInterval(() => {
                let ns = cs + 1 >= images.length ? 0 : cs + 1;
                $(images).eq(cs).fadeOut(1000);
                $(images).eq(ns).fadeIn(1000);

                cs = cs + 1 >= images.length ? 0 : cs + 1;
            }, 3000);
        },

        gallery_1(elem){
            this.gallery(elem)
        },
        gallery_2(elem){
            this.gallery(elem)
        },

        gallery(elem){
            elem.querySelectorAll(".image").forEach(x => {
                x.addEventListener("mousedown", e => {
                    if(e.which === 1) document.querySelector("#image-shower img").src = e.currentTarget.querySelector("img").src;
                });
            });
        },
    }

    Object.keys(func).forEach(key => { 
        let exist = document.querySelector("#" + key.replace("_", "-"));
        console.log(key, exist);
        exist && func[key](exist);
    });
});