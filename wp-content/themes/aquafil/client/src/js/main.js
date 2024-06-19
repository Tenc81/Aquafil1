import { Browser } from 'rxcomp';
import { AppModule } from './app.module';
import 'add-to-calendar-button';

Browser.bootstrap(AppModule);


[].forEach.call( document.getElementsByClassName('page--investors__accordion-title'), function( classnameElement ){
    classnameElement.addEventListener('click', function(){
      this.parentElement.classList.toggle('open');
    });
})  