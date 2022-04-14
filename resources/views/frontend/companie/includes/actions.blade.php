<x-utils.view-button :href="route('frontend.companie.show', $companie->uuid)" />

<x-utils.edit-button :href="route('frontend.companie.edit', $companie->uuid)" />

<x-utils.delete-button :href="route('frontend.companie.destroy', $companie->uuid)" />
