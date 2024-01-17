import { PageletEvent, Pagelets } from '@packaged-ui/pagelets';

Pagelets.init({ 'defaultTarget': 'main', 'selector': 'a:not(.nar)' });

document.addEventListener(Pagelets.events.PREPARE, (e: PageletEvent) => {
  e.detail.request.withCredentials = true;
});
