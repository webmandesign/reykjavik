# Reykjavik theme review

A free accessible WordPress theme, Reykjavik, by WebMan Design was submitted to WordPress.org theme repository for a theme review in mid July 2017. Theme was made live on ... And here is a report of the (painful) theme review process.


## Review process


### Jul 10

- [Submitted](https://themes.trac.wordpress.org/ticket/44682) for WPORG theme review


### Aug 28

- @joyously posted [user review list of issues](https://themes.trac.wordpress.org/ticket/44682#comment:2)


### Aug 29

- @alkesh7 [started reviewing](https://themes.trac.wordpress.org/ticket/44682#comment:5) the theme
- Update 0.9.2. Fixing most of @joyously user suggestions, with [request for further discussion](https://themes.trac.wordpress.org/ticket/44682#comment:7) for some of them.


### Aug 30

- Update 0.9.3. Identifying a user experience issue with WordPress itself (not with the theme) and [explaining why and how the theme displays menu description text](https://themes.trac.wordpress.org/ticket/44682#comment:10).


### Aug 31

- Update 0.9.4. Fixing errors thrown by NS Theme Check plugin.
- @joyously [replied to my update note](https://themes.trac.wordpress.org/ticket/44682#comment:13) and left the rest of the review to @alkesh7.


### Sep 2

- @alkesh7 [planning to start](https://themes.trac.wordpress.org/ticket/44682#comment:14) the theme review.


### Sep 8

- @alkesh7 posted a [list of required things](https://themes.trac.wordpress.org/ticket/44682#comment:16) (later this turned out to be only recommendations list...)
- Following with my [reply of explanations and (mostly unanswered and unexplained) questions](https://themes.trac.wordpress.org/ticket/44682#comment:17).


### Sep 9

- @kevinhaig explains the previous review list were recommendations only. [Pointing out an "issue" with theme demo content import](https://themes.trac.wordpress.org/ticket/44682#comment:19) functionality.


### Sep 12

- I've replied to @kevinhaig and @alkesh7 [demanding some explanations about why the previous list of recommendations was posted](https://themes.trac.wordpress.org/ticket/44682#comment:21) and explaining theme demo content import functionality.


### Sep 13

- With intervention from @greenshady the content demo import functionality was explained and approved in the theme.
- The theme submission ticket was closed as approved. But this was actually by mistake as the theme needs to run through accessibility review. @kevinhaig left this for @davidakennedy to reopen the ticket again.


### Sep 17

- [I've replied](https://themes.trac.wordpress.org/ticket/44682#comment:28) to theme approval.
- Update 0.9.5. This actually [creates a new theme submission ticket](https://themes.trac.wordpress.org/ticket/46546) instead of continuing in the current one. I'm starting to worry the theme will get forgotten in the queue...


### Sep 25

- [Asking for update](https://themes.trac.wordpress.org/ticket/44682#comment:29) on stuck theme review process.


### Oct 3

- @poena [starting a final theme review](https://themes.trac.wordpress.org/ticket/44682#comment:30).


### Oct 4

- @poena provides [list of requirements](https://themes.trac.wordpress.org/ticket/46546#comment:3).
- Asking for explanation for some of the points and receives the answer from @poena the same day!
- Discussing issue of **Child Theme Generator**, **TinyMCE Formats Dropdown**, **TGMPA Version** and **Custom Widgets Enhancements**.
- @jrf is stepping up to explain TGMPA Version issue. After discussion it turns out TRT (Theme Review Team) [checks the TGMPA script version upon specific PHP comment](https://themes.trac.wordpress.org/ticket/46546#comment:14)...


### Oct 6

- Update 0.9.6 and 0.9.7.


### Oct 7

- [Asking for more opinions](https://themes.trac.wordpress.org/ticket/46546#comment:21) about **TinyMCE Formats Dropdown**, **Child Theme Generator**, **CSS Stylesheet Generator** and **Custom Widgets Enhancements**.


### Oct 9

- Getting opinions from @greenshady and @williampatton.
- Planning to go forward and leaving **TinyMCE Formats Dropdown** and **Custom Widgets Enhancements** untouched. Removing (disabling, actually) **Child Theme Generator**. And making the theme to output CSS into HTML head (really?!) and thus disabling **CSS Stylesheet Generator**. Checking with @poena if I'm OK to proceed. [@poena is sick.](https://themes.trac.wordpress.org/ticket/46546#comment:27)


### Oct 12

- Update 0.9.8. Fixing reported issues and unable to add custom styles into TinyMCE editor...


### Oct 14

- Update 0.9.9. Making custom styles work in TinyMCE editor after [great tip from @greenshady](https://themes.trac.wordpress.org/ticket/46546#comment:34) (however, not understanding why this is allowed and generating CSS files in WordPress uploads folder [securely using native WordPress Filesystem API](https://themes.trac.wordpress.org/ticket/46546#comment:30) is not...).


### Oct 16

- Update 0.9.10 and 0.9.11. These are my [final theme updates before 1.0.0](https://themes.trac.wordpress.org/ticket/46546#comment:41).


### Oct 17

- Unfortunately, [@poena is stepping away from the review](https://themes.trac.wordpress.org/ticket/46546#comment:42) with noone to take over, leaving the theme review ticket open again...


### Oct

-