

    var sidebarIsOpen = true;

    var toggleBtn = document.getElementById('toggleBtn');

    toggleBtn.addEventListener('click',(event)=>{

        event.preventDefault();
        if(sidebarIsOpen){ // when toggle button is clicked, when closed
            sidebar.style.width ='10%'; 
            sidebar.style.transition ='0.2s all'
            content_container.style.width = '90%';
            cdm_logo.style.width='70px'
            sidebar_user_p.style.fontSize='12px';
           

            menuText = document.getElementsByClassName('menuText');
            for(var i =0; i<menuText.length; i++){
            menuText[i].style.display = 'none';
        }
        document.getElementsByClassName('menu-lists')[0].style.textAlign = 'center';
        sidebarIsOpen = false;

        }else{
            sidebar.style.width ='20%';
            content_container.style.width = '80%';
            cdm_logo.style.width='100px'
            sidebar_user_p.style.fontSize='15px';
            

            menuText = document.getElementsByClassName('menuText');
            for(var i =0; i<menuText.length; i++){
            menuText[i].style.display = 'inline-block';
        }
        document.getElementsByClassName('menu-lists')[0].style.textAlign = 'left';
        sidebarIsOpen=true;
        }

        
    });
    // show and hide the submenus
    document.addEventListener('click', function(e) {
        let clickedEl = e.target;

        if(clickedEl.classList.contains('showHideSubMenu')){
            let subMenu = clickedEl.closest('li').querySelector('.subMenus');
            let menuArrowIcon = clickedEl.closest('li').querySelector('.menuArrowIcon');

            //closing of submenus
            let subMenus = document.querySelectorAll('.subMenus');
            subMenus.forEach((sub) =>{
                if(subMenu != sub)
                sub.style.display = 'none';
            });
            //call function for show hide submenu
            showHideSubMenu(subMenu,menuArrowIcon);


        }
        
});
    //funtion show hide subMenu
    function showHideSubMenu(subMenu,menuArrowIcon){
                    //checking if there is submenu
            if(subMenu != null){

                if(subMenu.style.display === 'block') {
                    subMenu.style.display = 'none';
                    menuArrowIcon.classList.remove('fa-angle-down');
                    menuArrowIcon.classList.add('fa-angle-up');
                }
                else {
                    subMenu.style.display = 'block';
                    menuArrowIcon.classList.remove('fa-angle-up');
                    menuArrowIcon.classList.add('fa-angle-down');
                }
                
            }

    }

    //show and hide active class to menu
    //get the current page
    //use selector to get current menu or submenu
    //add the active class

    const pathArray = window.location.pathname.split('/');
    let curFile =pathArray[pathArray.length -1];
    
    let curNav = document.querySelector('a[href = "./' +curFile+'"]');
    curNav.classList.add('subMenuActive');
    let mainNav = curNav.closest('li.liMainMenu');
    mainNav.style.background = '#fdb44b';

    let subMenu = curNav.closest('.subMenus');
    let menuArrowIcon = mainNav.querySelector('i.menuArrowIcon');
    //call function for show hide submenu
    showHideSubMenu(subMenu,menuArrowIcon);