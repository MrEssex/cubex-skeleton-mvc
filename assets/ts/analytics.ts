// https://github.com/plausible/analytics/blob/master/tracker/src/plausible.js#L19
type AnalyticsOptions = {
  meta: string;
  props: object;
  revenue: number;
};

type TriggerPayload = {
  n?: string;
  u?: string;
  d?: string;
  r?: string | null;
  m?: string;
  p?: object;
  $?: number
};

class Analytics {
  private scriptEl: HTMLScriptElement = document.currentScript as HTMLScriptElement;
  private endpoint: string;
  private lastPage: string | undefined;

  constructor() {
    this.endpoint = this.getDefaultEndpoint();
    this.init();
  }

  init() {
    this.page();
  }

  private page() {
    if (this.lastPage === window.location.pathname) {
      return;
    }

    this.lastPage = window.location.pathname;
    this.trigger('pageview');
  }

  private trigger(eventName: string, options: AnalyticsOptions = { meta: '', props: {}, revenue: 0 }) {
    const payload: TriggerPayload = {
      n: eventName,
      u: window.location.href,
      d: this.scriptEl.getAttribute('data-domain') || window.location.hostname,
      r: document.referrer || null
    };

    if (options && options.meta) {
      payload.m = options.meta;
    }

    if (options && options.props) {
      payload.p = options.props;
    }

    if (options && options.revenue) {
      payload.$ = options.revenue;
    }

    const propAttributes = this.scriptEl.getAttributeNames().filter(name => name.startsWith('event-'));

    const props: object = payload.p || {};

    propAttributes.forEach((attribute: string) => {
      const propKey = attribute.replace('event-', '');
      const propValue = this.scriptEl.getAttribute(attribute);
      (props as any)[propKey] = (props as any)[propKey] || propValue;
    });

    const req = new XMLHttpRequest();
    req.open('POST', this.endpoint, true);
    req.setRequestHeader('Content-Type', 'text/plain');
    req.send(JSON.stringify(payload));

    req.onreadystatechange = () => {
      if (req.readyState === 4 && req.status === 200) {
        console.log('Event sent:', payload);
      }
    };
  }

  private getDefaultEndpoint() {
    return new URL(this.scriptEl.src).origin + '/api/v1/event';
  }
}


new Analytics();
