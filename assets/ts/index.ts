import { PageletEvent, Pagelets } from '@packaged-ui/pagelets';

Pagelets.init({ 'defaultTarget': 'main', 'selector': '[data-uri]' });

document.addEventListener(Pagelets.events.PREPARE, (e: PageletEvent) => {
  e.detail.request.withCredentials = true;
});
