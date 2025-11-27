import { HttpService } from '../../common/http/http.service';
import { environment } from '../../environment';

export class ProductRequestSloService {

  static submit$(data) {
    if (environment.flags.production) {
      return HttpService.http$('POST', environment.api + '/wp-admin/admin-ajax.php', data, 'application/x-www-form-urlencoded');
    } else {
      return HttpService.get$('/product-request/submit.json');
    }
  }

}
