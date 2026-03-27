# Industry Page - ACF Field Documentation

This document lists all ACF fields used in `new.php` and indicates which fields are **required** (marked with ⚠️) for each section to display.

---

## Section 1: Header (Hero)
**Condition:** Always displays (navigation required)

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `header_image` | Image (URL) | No | Background image for hero |
| `header_title` | Text | No | Main heading |
| `header_description` | Textarea/WYSIWYG | No | Subheading text |
| `header_logos` | Gallery | No | Trusted partner logos |

---

## Section 2: Why Piedmont Global
**Condition:** ⚠️ Displays only if `why_piedmont_global_new_title` has content

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| ⚠️ `why_piedmont_global_new_title` | Text | **Yes** | Section title |
| `why_piedmont_global_new_description` | WYSIWYG | No | Section description |
| `why_piedmont_global_list` | Repeater | No | Checklist items |
| ↳ `item` | Text | No | Individual list item |
| `why_piedmont_global_photo_new` | Image (URL) | No | Section image |

---

## Section 3: Tabs (Pre/Post Production)
**Condition:** ⚠️ Displays only if `tabs` repeater has rows

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `tab_section_heading` | Text | No | Section title |
| `tab_section_description` | Textarea | No | Section description |
| ⚠️ `tabs` | Repeater | **Yes** | Tab container |
| ↳ ⚠️ `tab_key` | Text | **Yes** | Unique key (e.g., "pre", "post") |
| ↳ `tab_title` | Text | No | Button label |
| ↳ `cards` | Repeater | No | Cards within tab |
| &nbsp;&nbsp;↳ `card_icon` | Image | No | Card icon |
| &nbsp;&nbsp;↳ `card_title` | Text | No | Card heading |
| &nbsp;&nbsp;↳ `card_items` | Repeater | No | List items |
| &nbsp;&nbsp;&nbsp;&nbsp;↳ `item_text` | Text | No | Item text |

---

## Section 4: Tabbed Section Cards (Solutions)
**Condition:** ⚠️ Displays only if `tabbed_section_cards` has terms

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `tabbed_section_heading` | Text | No | Section title |
| ⚠️ `tabbed_section_cards` | Taxonomy/Relationship | **Yes** | Solution terms |
| `tabbed_section_link` | Link/URL | No | "Explore" link |

**Term-level fields (on Solution taxonomy):**
| Field Name | Type | Description |
|------------|------|-------------|
| `tagline` | Text | Term tagline |
| `primary_description` | WYSIWYG | Term description |
| `featured_image` | Image | Term image |

---

## Section 5: Visual Moments (Carousel)
**Condition:** ⚠️ Displays only if `visual_moment` repeater has rows

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `visual_moment_title` | Text | No | Section title |
| `visual_moment_description` | Textarea | No | Section description |
| ⚠️ `visual_moment` | Repeater | **Yes** | Carousel slides |
| ↳ `small_title` | Text | No | Stage label |
| ↳ `big_title` | Text | No | Slide heading |
| ↳ `content` | WYSIWYG | No | Slide content |
| ↳ `image` | Image (URL) | No | Slide image |
| ↳ `list` | Repeater | No | Feature list |
| &nbsp;&nbsp;↳ `item` | Text | No | Feature item |
| ↳ `url` | URL | No | Explore link |

---

## Section 6: Green Section (Image + Text)
**Condition:** ⚠️ Displays only if `green_section_subtitle` has content

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `green_section_title` | Text | No | Small label text |
| ⚠️ `green_section_subtitle` | Text | **Yes** | Main heading |
| `green_section_description` | WYSIWYG | No | Description text |
| `green_section_image` | Image (URL) | No | Left column image |

---

## Section 7: Alternate Green Section (Accordion)
**Condition:** ⚠️ Displays only if `alternate_green_section_repeater` has rows

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `alternate_green_section_title` | Text | No | Section heading |
| ⚠️ `alternate_green_section_repeater` | Repeater | **Yes** | Accordion items |
| ↳ ⚠️ `title` | Text | **Yes** | Item title |
| ↳ `description` | Textarea | No | Item description |

---

## Section 8: Related Resources & FAQs
**Condition:** ⚠️ Displays only if `related_blogs` OR `faqs` has content

### Related Blogs
| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `related_blogs` | Relationship (Posts) | No* | Blog posts carousel |

### FAQs
| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| `faqs` | Repeater | No* | FAQ accordion |
| ↳ `question` | Text | No | Question text |
| ↳ `answer` | WYSIWYG | No | Answer content |

*At least one of `related_blogs` or `faqs` must have content for section to display.

---

## Section 9: CTA (Call to Action)
**Condition:** ⚠️ Displays only if `cta_title` has content

| Field Name | Type | Required | Description |
|------------|------|----------|-------------|
| ⚠️ `cta_title` | Text | **Yes** | CTA heading |
| `cta_description` | WYSIWYG | No | CTA description |
| `cta_image` | Image (URL) | No | Right side image |
| `cta_second_link` | URL | No | Secondary button link |

---

## Summary: Required Fields by Section

| Section | Required Field(s) |
|---------|-------------------|
| Header | None (always shows) |
| Why Piedmont | `why_piedmont_global_new_title` |
| Tabs | `tabs` repeater with `tab_key` |
| Tabbed Cards | `tabbed_section_cards` |
| Visual Moments | `visual_moment` repeater |
| Green Section | `green_section_subtitle` |
| Alternate Green | `alternate_green_section_repeater` with `title` |
| Resources/FAQs | `related_blogs` OR `faqs` |
| CTA | `cta_title` |
