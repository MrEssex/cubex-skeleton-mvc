// @ts-ignore
import { PageletEvent, Pagelets } from "@packaged-ui/pagelets";

console.log('Hello World');

Pagelets.init({ "defaultTarget": "main", "selector": "a:not(.nar)" });

//@ts-ignore
document.addEventListener(Pagelets.events.PREPARE, (e: PageletEvent) => {
  e.detail.request.withCredentials = true;
});