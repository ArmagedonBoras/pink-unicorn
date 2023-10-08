@props(['active'])

<div x-data="{
    activeTab: (window.location.hash.length > 0) ? window.location.hash.substring(1) : '{{ $active }}',
    tabs: [],
    tabHeadings: [],
    tabLabels: [],
    tabIcons: [],
    toggleTabs() {
        this.tabs.forEach(
            tab => tab.__x.$data.showIfActive(this.activeTab)
        );
        window.location.hash = this.activeTab;
    }
}" x-init="() => {
    tabs = [...$refs.tabs.children];
    tabHeadings = tabs.map((tab, index) => {
        tab.__x.$data.id = (index + 1);
        return tab.__x.$data.name;
    });
    tabLabels = tabs.map((tab, index) => {
        return tab.__x.$data.label;
    });
    tabIcons = tabs.map((tab, index) => {
        return 'bi-' + tab.__x.$data.icon;
    });
    toggleTabs();

}">
    <ul class="nav nav-tabs mb-2" role="tablist">
        <template x-for="(tab, index) in tabHeadings" :key="index">
            <li class="nav-item" role="presentation">
                <a x-on:click="activeTab = tab; toggleTabs();" class="nav-link"
                    :class="tab === activeTab ? 'active show' : ''" :id="`tab-${index + 1}`" role="tab"
                    :aria-selected="(tab === activeTab).toString()" :aria-controls="`tab-panel-${index + 1}`"
                    style="cursor: pointer;">
                    <span class="m-1">
                        <i :class="tabIcons[index]"></i>
                    </span>
                    <span x-text="tabLabels[index]"></span>
                </a>
            </li>
        </template>
    </ul>

    <div x-ref="tabs">
        {{ $slot }}
    </div>
</div>
