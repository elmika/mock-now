# POC: Manage time dependencies in objects

Sample object with methods depending on current time.
We want to inject a clock in order to run unit tests consistently.

BookingObject::book
BookingObject::confirmBooking

With the following rule: if more than 5 minutes have passed between book 
and confirmBooking, then confirmation should fail (new booking is required).