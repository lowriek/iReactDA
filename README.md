# iReactDA
DA audience reaction tool

Initial version is designed to have multiple people reacting to a live performance, and to display those reactions in a graph.

Model
composition - composition with a composername

collection - one or more per composition, is a grouping of reaction data for a performance of a composition.
Currently working on recording the performance with time stamps to be stored in a file.  It would be better, I think to use time delta since the start of the performance.


reactiondata - time, reaction pairs for the duration of collection (time, reaction). Currently reaction data is anonymous.

view
reactor - user who is using a wifi enabled smart phone to record and view their reactions to a performance.

collector - administrator of reaction collections

MVC - reactor
Views current collection collection enabled (if there is one)
Views current reaction options (like, neutral, dislike)
selects current reaction
submits reactions at the of the performance

MVC - collector
Views forms to
- create compositions
- create and enable collections of reactions to compositions
- create recording with beginning and ending timestamps (future)
- display collected reactions over time


Features to add:
- display multiple reaction listItems
- make reactions distinct, but still anonymous
- maybe make reactions non-anonymous?
- tie reactions to a recording
- look at a smaller reaction timeframe.
- naming issues?
  main collection pages are php, should rename php helpers
